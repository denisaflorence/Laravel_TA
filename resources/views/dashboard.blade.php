@extends('template/home')

@section('isi_konten')
<!-- SRC DATATABLE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="main-content">
        <div class="row report-group">
            <div class="col-sm-12">
                <div class="item-big-report col-md-12">
                    <table class="table-wisata table-tiketsaya table " id ="produk-table">
                        <thead>
                            <h2>Status Ketersediaan Produk</h2>
                            <tr class="1"> 
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Status</th>
                                <th scope="col">Jumlah Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $item)
                            <tr class="4" style="background-color: #DAC1AE">
                                <td>{{$item->nama_produk}}</td>
                                @if($item->status == 'Tidak Tersedia')
                                <td class="bg-danger">{{$item->status}}</td>
                                @elseif($item->status == 'Stok Menipis')
                                <td class="bg-warning">{{$item->status}}</td>
                                @else
                                <td class="bg-success">{{$item->status}}</td>
                                @endif
                                <td>{{$item->jumlah_stok}}</td>
                            </tr> 
                            @endforeach


                        </tbody>
                    </table>


                </div>
                <div class="item-big-report col-lg-12">
                    <table class="table-wisata table-tiketsaya table " id ="produk-table">
                        <thead>
                        <h2>Laporan Piutang</h2>
                            <tr class="1">
                                <th scope="col">Nama Pembeli</th>
                                
                                <th scope="col">Sisa Bayar</th>
                                <th scope="col">Tanggal Pelunasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exit as $item)
                            <tr class="4" style="background-color: #DAC1AE">
                                <td>{{$item->nama_reseller}}</td>
                                
                                <td>{{$item->total}}</td>
                                <td>{{$item->tanggal_pelunasan}}</td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection