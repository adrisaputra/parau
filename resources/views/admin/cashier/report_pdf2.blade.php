<script src="{{ asset('assets/js/recta.js') }}"></script>

<script type="text/javascript">
  var printer = new Recta('8131703583', '1811')

  window.onload = function(){
    printer.open().then(function () {
      printer.align('center')
      
      .font('A')
        .bold(true).text('PARAU.ID !!').bold(false)
        .text('{{ $sellingTransaction->user->outlet->address }}')
        .text('{{ $sellingTransaction->user->outlet->outlet_name }}')
        .text('No. Hp: {{ $sellingTransaction->user->outlet->phone }}')
        .text('===============================')
        
        .font('B')
        .align('LEFT')
        @php $line = sprintf('%0.40s %-6s %0.40s %0s %18.40s',$sellingTransaction->created_at->format('D,d-m-Y'),'','','',$sellingTransaction->user->name); @endphp
        .text('{{ $line }}')
        .text('Waktu : {{ $sellingTransaction->created_at->format("H:i") }}')
        .text('{{ $sellingTransaction->transaction_number }} \n')
        
      .font('A')
        @foreach($sellingDetail as $v) 
             @php $harga = number_format($v->product->selling_price, 0, ',', '.'); @endphp
             @php $jumlah = number_format($v->amount, 0, ',', '.'); @endphp
             @php $total = number_format($v->amount * $v->product->selling_price, 0, ',', '.'); @endphp
            
            // .initialize();
            .text('{{ $v->product->product_name }}')
            // .setJustification(Printer::JUSTIFY_LEFT);
            
            @php $line2 = sprintf('%-3.40s %-3s %8.40s %1s %13.40s',$jumlah, 'X', $harga, ':',$total); @endphp
            .text('{{ $line2 }}')
        @endforeach 

        .text('--------------------------------')
        @php $line3 = sprintf('%-6.40s %6.40s %0s %13.40s','Sub Total','',':',number_format($sellingTransaction->total_price, 0, ',', '.')); @endphp
        .text('{{ $line3 }}')
        @php $line4 = sprintf('%-6.40s %-2s %6.40s %0s %13.40s','Diskon','','',':',number_format($sellingTransaction->discount, 0, ',', '.')); @endphp
        .text('{{ $line4 }}')
        @php $line5 = sprintf('%-3.40s %-3s %6.40s %0s %13.40s','Total','','',':',number_format($sellingTransaction->total_price - $sellingTransaction->discount, 0, ',', '.')); @endphp
        .text('{{ $line5 }}')
        @php $line6 = sprintf('%-3.40s %-3s %6.40s %0s %13.40s','Bayar','','',':',number_format($sellingTransaction->pay_cost, 0, ',', '.')); @endphp
        .text('{{ $line6 }}')
        @php $line7 = sprintf('%-3.40s %-3s %4.40s %0s %13.40s','Kembali','','',':',number_format($sellingTransaction->pay_cost - ($sellingTransaction->total_price - $sellingTransaction->discount), 0, ',', '.')); @endphp
        .text('{{ $line7 }}\n')

        .align('CENTER')
        .text('--------------------------------')
        .text('*** Terima Kasih ***')
        .text('Atas Kunjungan Anda')
        .text('--------------------------------')

        .cut()
        .print()
    })

    window.location.href = "{{ url('/cashier/create') }}";
  }
  
</script>