<!doctype html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

<h3>CI4 Log Viewer</h3>

<form method="get">
<select name="file" onchange="this.form.submit()" class="form-select w-25">
<option>Select log file</option>
<?php foreach($files as $f): ?>
<option value="<?= esc($f) ?>" <?= ($file===$f?'selected':'') ?>><?= esc($f) ?></option>
<?php endforeach ?>
</select>
</form>

<table class="table table-sm mt-4">
<tr><th>Level</th><th>Message</th></tr>
<?php foreach($logs as $log): ?>
<tr>
<td><?= esc($log['level'] ?? '') ?></td>
<td><pre><?= esc($log['message'] ?? '') ?></pre></td>
</tr>
<?php endforeach ?>
</table>

</body>
</html>