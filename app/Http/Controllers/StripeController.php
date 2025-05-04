<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Property;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PDF; // Nécessite l'installation de laravel-dompdf ou autre package PDF

class StripeController extends Controller
{

    public function checkout(Request $request, Property $property)
    {
        // dd($property);
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $property->title,
                    ],
                    'unit_amount' => $property->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['property' => $property->id]),
            'cancel_url' => route('home'),
        ]);

        return redirect($session->url);
    }
    public function paymentSuccess(Request $request, $propertyId)
    {
        // Récupérer l'annonce
        $annonce = Property::findOrFail($propertyId);
        // dd($annonce);
        // Marquer l'annonce comme payée
        if (!$annonce->is_paid) {
            $annonce->update(['is_paid' => true, 'status' => 'non disponible']);

            // Créer un enregistrement de paiement
            Paiement::create([
                'user_id' => auth()->id(),
                'annonce_id' => $annonce->id,
                'amount' => $annonce->price * 100,
                'currency' => 'eur',
                'status' => 'completed',
            ]);
        }

        return view('succes');
    }

    public function success(Request $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);

        // Vérification que le paiement a bien été effectué
        $paiement = Paiement::create([
            'user_id' => auth()->id(),
            'property_id' => $property->id,
            'amount' => $property->price * 100, // montant en centimes
            'currency' => 'eur',
            'status' => 'completed', // Le paiement est validé
        ]);

        // Mettre à jour l'annonce pour qu'elle soit marquée comme payée
        $property->update(['is_paid' => true]);

        return view('payment.success', compact('paiement'));
    }

    public function download($id)
    {
        $paiement = Paiement::findOrFail($id);
    
        $user = $paiement->user;
        $annonce = $paiement->annonce;
    
        if ($paiement->user_id !== auth()->id()) {
            abort(403, 'Vous n\'êtes pas autorisé à accéder à cette facture.');
        }
    
        $facturePath = 'factures/facture-' . $paiement->id . '.pdf';
    
        if (Storage::exists($facturePath)) {
            return Storage::download($facturePath, 'facture-' . $paiement->id . '.pdf');
        }
    
        // Sinon, générer la facture
        $data = [
            'paiement' => $paiement,
            'annonce' => $annonce,
            'user' => $user,
            'numero_facture' => 'F-' . date('Ymd') . '-' . $paiement->id,
            'date_facture' => $paiement->created_at->format('d/m/Y'),
        ];
    
        $pdf = PDF::loadView('facture', $data);
    
        // Sauvegarder la facture pour utilisation future
        Storage::put($facturePath, $pdf->output());
    
        // Télécharger la facture
        return $pdf->download('facture-' . $paiement->id . '.pdf');
    }
    
}
