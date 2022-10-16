<?php

namespace App\Http\Controllers;

use App\Models\Devie;
use App\Models\Facture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintingController extends Controller
{
    public function imprimer($id, $type)
    {
        if ($type == "devie") {
            $devie = Devie::where('num', $id)->first();
            $price_total = DB::table('devie_produit')
                ->join('produits', 'devie_produit.produit_id', '=', 'produits.id')
                ->join('devies', 'devie_produit.devie_id', '=', 'devies.num')
                ->selectRaw('SUM(produits.price*quantity)*0.2 + SUM(produits.price*quantity) as total_price')
                ->where('devies.num', $devie->num)
                ->first()
                ->total_price;
            $price_total_letter = $this->convert_number($price_total);
            return view('impression', compact('devie', 'price_total_letter'));
        }elseif($type == "facture"){
            $facture = Facture::where('num', $id)->first();
            $price_total = DB::table('facture_produit')
                ->join('factures', 'facture_produit.facture_id', '=', 'factures.num')
                ->join('produits', 'facture_produit.produit_id', '=', 'produits.id')
                ->selectRaw('SUM(produits.price*quantity)*0.2 + SUM(produits.price*quantity) as total_price')
                ->first()
                ->total_price;
            $price_total += DB::table('devie_produit')
                ->join('produits', 'devie_produit.produit_id', '=', 'produits.id')
                ->join('devies', 'devie_produit.devie_id', '=', 'devies.num')
                ->join('factures', 'devies.num', '=', 'factures.devie_id')
                ->selectRaw('SUM(produits.price*quantity)*0.2 + SUM(produits.price*quantity) as total_price')
                ->first()
                ->total_price;
            $price_total_letter = $this->convert_number($price_total);
            return view('impression', compact('facture', 'price_total_letter'));
        }
    }
    function convert_number($number)
    {
        if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }
        // Millions (giga)
        $giga = floor($number / 1000000);
        $number -= $giga * 1000000;
        // Thousands (kilo)
        $kilo = floor($number / 1000);
        $number -= $kilo * 1000;
        // Hundreds (hecto)
        $hecto = floor($number / 100);
        $number -= $hecto * 100;
        // Tens (deca)
        $deca = floor($number / 10);
        // Ones
        $n = $number % 10;
        $result = ""; // store the converted number.
        if ($giga) {
            $result .= $this->convert_number($giga) .  "Million";
        }
        if ($kilo) {
            // $result .= (empty($result) ? "" : " ") .$this->convert_number($kilo) . " Thousand";
            $result .= (empty($result) ? "" : " ") . $this->convert_number($kilo) . " Mille";
        }
        if ($hecto) {
            // $result .= (empty($result) ? "" : " ") .$this->convert_number($hecto) . " Hundred";
            $result .= (empty($result) ? "" : " ") . $this->convert_number($hecto) . " Cent";
        }
        // $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $ones = array(
            '',
            'un',
            'deux',
            'trois',
            'quatre',
            'cinq',
            'six',
            'Sept',
            'huit',
            'neuf',
            'dix',
            'onze',
            'douze',
            'treize',
            'quatorze',
            'quinze',
            'sieze',
            'dix-sept',
            'dix-huit',
            'dix-neuf',
        );
        // $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        $tens = array(
            '',
            '',
            'vingt',
            'trente',
            'quarante',
            'cinquante',
            'soixante',
            'soixante-dix',
            'quatre-vingts',
            'quatre-vingts-dix'
        );
        if ($deca || $n) {
            if (!empty($result)) {
                $result .= " ";
            }
            if ($deca < 2) {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) {
                    // $result .= "-" . $ones[$n];
                    $result .= " " . $ones[$n];
                }
            }
        }
        if (empty($result)) {
            $result = "zero";
        }
        return $result;
    }
}
