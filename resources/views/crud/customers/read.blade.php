<fieldset style="width:700px; margin:auto;">
	<legend>Customers</legend>
	<div style="margin-bottom:5px;"><a href="{{ url('create') }}">Create</a></div>
	<table cellpadding="5" border="1" style="width:100%; border-collapse: collapse;">
		<tr>
			<td>Name</td>
			<td>Email</td>
			<td>Address</td>
			<td>Phone</td>
			<td style="width:150px;"></td>
		</tr>
		@foreach($data as $row)
		<tr>
			<td>{{ $row->name }}</td>
			<td>{{ $row->email }}</td>
			<td>{{ $row->address }}</td>
			<td>{{ $row->phone }}</td>
			<td style="text-align:center;">
				<a href="{{ url('update/'.$row->id) }}">Update</a>&nbsp;&nbsp;
				<a href="{{ url('delete/'.$row->id) }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</table>
	<!-- trong laravel hỗ trợ sẵn hàm phân trang -->
	{{ $data->render() }}
</fieldset>
<style type="text/css">
	body{font-family: Arial;}
	a{text-decoration: none;}
</style>
