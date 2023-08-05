<fieldset style="width:300px; margin:auto;">
	<legend>Create update</legend>
	<form method="post" action="{{ $action }}">
		@csrf
		<table cellpadding="5">
			<tr>
				<td>Name</td>
				<td><input type="text" value="{{ isset($record->name)?$record->name:'' }}" name="name"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" value="{{ isset($record->email)?$record->email:'' }}" name="email" required></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input type="text" value="{{ isset($record->phone)?$record->phone:'' }}" name="phone"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" value="{{ isset($record->address)?$record->address:'' }}" name="address"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Thực hiện"></td>
			</tr>
		</table>
	</form>
</fieldset>