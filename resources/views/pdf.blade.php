<style media="screen">
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12px;
    }
    table, th, td {
       border: 1px solid black;
       padding: 2px;
    }
    .text-center{
      text-align: center;
    }
    .text-right {
      text-align: right;
    }
    p {
      font-size: 10px;
    }
  </style>
  <p>
    {{config('app.perusahaan')}}<br/>
    {{config('app.alamat')}}<br/>
  </p>
  <center><h4>LAPORAN REKAP BARANG</h4></center>
  <table id="datatables" class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
      <th class="col-md-1 text-center">No</th>
      <th class="text-center">No Transaksi</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Jumlah Barang</th>
      <th class="text-center">Sub Total</th>
      <th class="text-center">Diskon</th>
      <th class="text-center">Ongkir</th>
      <th class="text-center">Total</th>

    </tr>
    </thead>
    <tbody>
        @php
        $no = 0;
        $grand_total = 0;
    @endphp
    @foreach ($data as $item)
    @php
        $no++;
        $jumlah_barang = 0;
        foreach ($item->sales_details as $sd) {
            $jumlah_barang += $sd->kuantitas;
        }
        $grand_total += $item->total_bayar;
    @endphp
<tr>
        <td class="text-center">{{$no}}</td>
        <td class="text-center">{{$item->kode}}</td>
        <td class="text-center">{{$item->customer->name}}</td>
        <td class="text-center">{{number_format($jumlah_barang)}}</td>
        <td class="text-left">Rp {{ number_format($item->sub_total,2) }}</td>
        <td class="text-center">Rp {{ number_format($item->diskon,2) }}</td>
        <td class="text-left">Rp {{ number_format($item->ongkir) }}</td>
        <td class="text-center">Rp {{ number_format($item->total_bayar,2) }}</td>
      </tr>
    @endforeach
  </tbody>
  <tfoot class="bg-light">
     <tr>
         <td colspan="7"><b>Grand Total :</b></td>
         <td colspan="2"><b>Rp {{ number_format($grand_total,2) }}</b></td>
     </tr>
    </tfoot>

  </table>
  <p>Tanggal Cetak : <?php echo date('d-m-Y'); ?> </p>
  <p>Dicetak Oleh<br/><br/><br/>
  {{Auth::user()->name}}
  </p>
  