<div id="reload_cart">
												<table class="highlight collection email-collection">
													<tbody>
														@php $total = 0 ;@endphp
														@foreach ($purchaseDetail as $v)
														<tr role="row" class="odd">
															<input type="hidden" class="form-control" value="{{ $v->id }}" id="id{{ $v->id }}">
															<td style="width: 90%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger"><b>{{ $v->product->product_name }}<b><br><p style="font-size:10px;">{{ number_format($v->product->purchase_price, 0, ',', '.') }}</p></td>
															<td style="width: 5%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger">x{{ $v->amount }}</td>
															<td style="width: 90%" onclick="productModal({{ $v->product->id }})" href="#modal" class="modal-trigger">{{ number_format($v->price, 0, ',', '.') }}</td>
															<td style="width: 1%">
															<a class="btn btn-small waves-effect waves-light red darken-1" onclick="DeletePoCart{{ $v->id }}()" ><small class="nav-icon fas fa-trash"></small> Hapus</a>
															</td>
														</tr>
														<script>
														function DeletePoCart{{ $v->id }}() {
																
															id = document.getElementById("id{{ $v->id }}").value;
															url = "{{ url('/preorder/delete_item_po') }}"
															$.ajax({
																type: "POST",
																url: "{{ url('/preorder/delete_item_po') }}",
																data: {
																	'id': id,
																	'_token': $('input[name=_token]').val(),
																},                            
																success: function( data ) {
																	$("#reload_cart").load(window.location.href + "/refresh" );
																}
															});

															

														}
														</script>
														@php $total = $total + $v->price; @endphp
														@endforeach
														
														<tr role="row" class="odd">
															<input type="hidden" id="total_price" value="{{ $total }}" readonly>
															<th colspan=2><p style="font-size:20px;">Total</p></th>
															<th colspan=2><p style="font-size:20px;color:green">{{ number_format($total, 0, ',', '.') }}</p></th>
														</tr>
													</tbody>
												</table>
												</div>