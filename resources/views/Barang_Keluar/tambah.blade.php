@extends('template/home')

@section('css')
@parent
<style>
    body {
        margin: 0;
        color: #2e323c;
        background: #f5f6fa;
        position: relative;
        height: 100%;
    }

    .text-center {
        margin-top: 20px;
    }
</style>
@endsection
@section('isi_konten')
<form action="/insertexit" method="POST">
    @csrf
    <div class="main-content">
        <div class="card-body" style="margin-top: 40px">
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h5 class="mb-3 text-primary">Tambah Barang Keluar</h5>
                </div>
                <div class="row  ml-2">
                    <div class="col">
                        <label for="fullName" class='font-weight-bold'>Nama Reseller</label>
                        <select class="form-control mt-2 ab-t-rpt-2" name="reseller_id" id="reseller" required>
                            <option value="">--Nama Reseller--</option>
                            @foreach($reseller as $items)
                            <option value="{{ $items->reseller_id .'|'. $items->grade_id }}">
                                {{ $items->grade_id.'-'.$items->nama_reseller }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row gutters ml-2">
                    <div class="col">
                        <label for="fullName" class='font-weight-bold'>No. Nota</label>
                        <input type="text" class="form-control" id="fullName" value="{{$nota[0]->ID}}" name="nota_id"
                            readonly>
                    </div>
                    
                    <div class="col mb-4">
                        <label for="phone" class='font-weight-bold'>Tanggal</label>
                        <input type="text" class="form-control datepicker" id="from-datepicker"
                            value="{{ now()->format('d/m/Y') }}" name="tanggal">
                    </div>
                </div>

                <div class="row ml-2">
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <label for="fullName" class='font-weight-bold'>Nama Produk</label>
                        </div>
                        <div class="col-md-2">
                            <label for="fullName" class='font-weight-bold'>Jumlah Per Produk </label>
                        </div>
                        <div class="col-md-2">
                            <label for="eMail" class='font-weight-bold'>Harga Satuan</label>
                        </div>
                        <!-- <div class="col-md-2">
                            <label for="eMail" class='font-weight-bold'>Tanggal Pelunasan</label>
                        </div> -->
                        <div class="col-md-3">
                            <label for="eMail" class='font-weight-bold'>Subtotal</label>
                        </div>
                    </div>
                    <div id="wrapNota">
                        <div class="col-md-12 row row-nota">
                            <div class="col-md-4">
                                <select class="form-control mt-2 ab-t-rpt-2" name="produk_id[]" >
                                    <option value="">--Nama Produk--</option>
                                    @foreach($produk as $items)
                                    <option value="{{ $items->produk_id }}">{{ $items->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control mt-2" name="jumlah[]">
                                <!-- JUMLAH KUTUSNYA BELOM ADA IF -->

                            </div>
                            <div class="col-md-2">
                                <select class="form-control mt-2 ab-t-rpt-2" name="harga_satuan[]" readonly>
                                    <option value="" readonly>--Harga Produk--</option>
                                    @foreach($produk as $items)
                                    <option readonly value="{{ $items->harga_jual }}"> @currency($items->harga_jual)  </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- <div class="col-md-2">
                                <input type="text" class="form-control mt-2" name="harga_diskon[]" readonly>
                            </div> -->
                            <div class="col-md-3">
                                <input type="text" class="form-control mt-2" name="total_harga_penjualan[]" readonly>
                            </div>


                        </div>
                    </div>
                    <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"> -->
                    <div class="text-center" style="margin-top:50px;">
                         <button type="button" id="tambah_produk" class="btn btn-success btn-md mt-2 text-right ml-3">Tambah Produk</button>
                        <!-- <button type="reset" class="btn btn-secondary btn-lg">Batal</button>
                        <button type="submit" id="submit" class="btn btn-primary btn-lg" >Tambah</button> -->
                    </div>
                </div>


                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-center" style="margin-top:80px;">
                        <button type="reset" class="btn btn-secondary btn-lg">Batal</button>
                        <button type="submit" id="submit" class="btn btn-primary btn-lg" >Tambah</button>
                    </div>
                </div>
            </div>
        </div>
</form>


<div id="templateNota" class="d-none">
    <div class="col-md-12 row row-nota">
        <div class="col-md-4">
            <select class="form-control mt-2 ab-t-rpt-2" name="produk_id[]" >
                <option value="">--Nama Produk--</option>
                @foreach($produk as $items)
                <option value="{{ $items->produk_id }}">{{ $items->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control mt-2" name="jumlah[]">
        </div>
        <div class="col-md-2">
            <select class="form-control mt-2 ab-t-rpt-2" name="harga_satuan[]" readonly>
                <option value="">--Harga Produk--</option>
                @foreach($produk as $items)
                <option value="{{ $items->harga_jual }}">@currency($items->harga_jual)</option>
                @endforeach
            </select>
        </div>
<!-- 
        <div class="col-md-2">
            <input type="text" class="form-control mt-2" name="harga_diskon[]" readonly>
        </div> -->
        <div class="col-md-3">
            <input type="text" class="form-control mt-2" name="total_harga_penjualan[]" readonly>
        </div>
        <div class="col-sm-1">
            <a class="btn btn-danger btn-sm btn-delete-row " style="margin-top: 2px;"><i class="far fa-2x fa-trash-alt" style="color: white;"></i></a>
        </div>
    </div>
</div>



@endsection

@section('js')
@parent
<script>
    var grade = '{{ $grade }}',
        gradeId,
        resellerId,
        produkId,
        hargaDiskon,
        pointerHargaProduk,
        pointerHargaDiskon;


    $('#reseller').change(function () {
        let tempValue = $(this).val().split('|');
        resellerId = tempValue[0];
        gradeId = tempValue[1];
        // console.log(tempValue);
    });

    $(document).on('change', '[name^="produk_id"]', function () {
        produkId = this.value;

        $(this).closest('.row-nota')
            .find('[name^="harga_satuan"] option')
            .eq($(this)[0].selectedIndex)
            .prop('selected', true);

        pointerHargaProduk = $(this).closest('.row-nota')
            .find('[name^="harga_satuan"]');

        let jumlah = $(this).closest('.row-nota')
        .find('[name^="jumlah"]')
        .val();

        if (jumlah)
            $(this).closest('.row-nota')
                .find('[name^="total_harga_penjualan"]')
                .val(jumlah * pointerHargaProduk.val()  );

        pointerHargaDiskon = $(this).closest('.row-nota')
            .find('[name^="harga_diskon"]');
        calculateValue(gradeId, produkId);
        

    });

    $(document).on('keyup', '[name^="jumlah"]', function () {
        $(this).closest('.row-nota')
            .find('[name^="total_harga_penjualan"]')
            .val(this.value * hargaDiskon);
    })

    $(document).on('click', '.btn-delete-row', function() {
        $(this).closest('.row-nota').remove();
    })

    $('#tambah_produk').click(function () {
        let template = $('#templateNota').html();
        $('#wrapNota').append(template);
    })

    function calculateValue(gradeId, produkId) {
        $.ajax({
            url: `{{ url('/calexit') }}`,
            data: {
                grade_id: gradeId,
                produk_id: produkId,
                _token: "{{ csrf_token() }}"
            },
            method: 'POST'
        }).done(function (data) {
            hargaDiskon = pointerHargaProduk.val() - data.potongan;
            pointerHargaDiskon.val(hargaDiskon);
        }).fail(function () {
            alert('data tidak ditemukan!')
        })
    }
</script>

@endsection
