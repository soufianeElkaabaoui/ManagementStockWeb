@extends('app')

@section('title','Ajouter Facture')

@section('custom_meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('custom_libs')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content_page')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
      <!-- Page header -->
        <div class="border-bottom pb-4 mb-4 ">
            <h3 class="mb-0 fw-bold">Ajouter une Facture</h3>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <form action="{{ route('facture.store') }}" method="post">
            @csrf
        <div class="card h100">
            <div class="card-header bg-white py-4">
                <div class="row">
                    {{-- <div class="col-xs-12 col-md-4">
                        <input class="form-control form-control-sm mb-3" placeholder="N° facture" type="text" id="facture_num" name="facture_num" disabled value="{{ old('facture_num') }}">
                    </div> --}}
                    <div class="col-xs-12 col-md-8 w-100">
                        <div class="input-group">
                            <select class="livesearchclient form-control" id="client" name="client"></select>
                            <button class="btn btn-secondary btn-sm w-30 ms-8" type="button" id="btn_add_produit">{{--<i class="bi bi-plus"></i>--}}Ajouter Commande</button>
                            <button class="btn btn-secondary btn-sm w-30 ms-8 d-none" type="button" id="btn_update_produit">{{--<i class="bi bi-pencil-square"></i>--}}Modifier Commande</button>                
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xs-12 col-md-6">
                        <div class="input-group">
                            <select class="livesearchproduit form-control" id="list_produits" name="livesearchproduit"></select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <input class="form-control form-control-sm" placeholder="QTE" type="text" id="produit_qte">
                        <input type="hidden" id="produit_price">
                        <input type="hidden" name="produits" id="produits_ids">
                        <input type="hidden" name="quantities" id="quantities_values">
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="input-group">
                            <input class="form-control form-control-sm" placeholder="Prix Total" type="text" id="produit_price_total">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive mx-2 mb-3">
            <table class="table text-nowrap w-100 mb-0">
                <thead class="table-light w-100">
                    <tr>
                        <th>N°</th>
                        <th>REF</th>
                        <th>Libelle</th>
                        <th>Unité</th>
                        <th>Prix U</th>
                        <th>Quantité en stock</th>
                        <th>Quantité</th>
                        <th>Prix T</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tbl_tbody_produits">
                    
                </tbody>
                <tfoot id="tbl_tfoot_price_global">
                        <tr>
                            <td colspan="2">Prix total HT</td>
                            <td colspan="7" id="prix_total_facture_HT">...</td>
                        </tr>
                        <tr>
                            <td colspan="2">Prix total (TT) du devie</td>
                            <td colspan="7" id="prix_total_facture_TT">...</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @if (session('status'))
            <div class="alert alert-success mx-2" role="alert">
                {{ session('status', '') }}
            </div>
            @endif
            @if ($errors->any())
            <ul class="list-group mx-2">
                @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger mb-2">{{ $error }}</li>
                @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
<div class="col-xs-12 mt-2">
    <button type="submit" name="btnAdd" id="btnAdd" class="btn btn-primary btn-sm w-100">Confirmer la facture</button>
</div>
@endsection

@section('custom_script')
<script>
    var produits = {{ Illuminate\Support\Js::from($produits) }};
</script>
<script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/facture/add-facture.js') }}"></script>
@endsection
