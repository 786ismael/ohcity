<!DOCTYPE html>
<html>
<head>
	<title>Support Email</title>

	<style type="text/css">
		table {
    padding: 0;
    margin: 0;
    font-family: sans-serif;
    border-spacing: 0;
    font-size: 14px;
}

table th {
    margin-bottom: 0px;
    color: #808080;
}

table strong {
    color: #8a8a8a;
}
	</style>
</head>
<body>

<table>
	<tr>
		<td><strong>Name:</strong></td>
		<td><?php echo $first_name.' '.$last_name ?></td>
	</tr>
	<tr>
		<td><strong>Email:</strong></td>
		<td><?php echo $email_address ?></td>
	</tr>
	<tr>
		<td><strong>Mobile:</strong></td>
		<td><?php echo $contact_number ?></td>
	</tr>
	<tr>
		<td colspan="2"><strong>Message:</strong></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $message ?></td>
	</tr>
</table>
</body>
</html>