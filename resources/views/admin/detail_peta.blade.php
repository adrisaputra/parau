       

	<div class="modal-content">
		<h5>Data Pekerjaan</h5>
		<div id="view-borderless-table ">
			<div class="row">
				<div class="col s12 " style="overflow-x:auto;">
					<table class="highlight">
						<tbody>
							<tr>
								<td style="width:20%">Nama Client</td>
								<td  style="width:80%">: {{ $project->client_name }}</td>
							</tr>
							<tr>
								<td>No. HP</td>
								<td>: {{ $project->phone }}</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>: {{ $project->address }}</td>
							</tr>
						</tbody>
					</table>
					<br>
					<table class="highlight">
					<thead>
						<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
							<th style="width: 60px">No</th>
							<th>Nama Pekerjaan</th>
							<th>Waktu Kerja</th>
							<th>Estimasi (Hari)</th>
							<th>Estimasi (Hari)</th>
							<th>Tim</th>
						</tr>
					</thead>
					<tbody>
						@foreach($project_detail as $v)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td>{{ $v->work_name }}</td>
							<td>Mulai <b>{{ date('d-m-Y', strtotime($v->work_start)) }}</b><br> Sampai <b>{{ date('d-m-Y', strtotime($v->work_end)) }}</b></td>
							<td>{{ $v->estimation }} Hari</td>
							<td>
								@if($v->status=='ON PROGRESS')
									<span class="new badge orange" data-badge-caption="Dalam Proses Pengerjaan"></span><br>
								@elseif($v->status=='DONE')
									<span class="new badge green" data-badge-caption="Selesai"></span><br>
								@else
									<span class="new badge red" data-badge-caption="Belum waktu pengerjaan"></span><br>
								@endif
							</td>
							<td>{{ $v->team->team_name }}</td>
						</tr>
						@endforeach
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close mb-12 btn waves-effect waves-light red darken-1">Tutup</a>
	</div>
    