<!DOCTYPE html>
<html>
<head>
    <title>New Job Alert</title>
</head>
<body>
<h1>New Job Alert</h1>
<p>A new job has been posted that matches your preferences:</p>
<ul>
    <li><strong>Name:</strong> {{ $job->name }}</li>
    <li><strong>Company:</strong> {{ $job->company_namee }}</li>
    <li><strong>Skills:</strong> {{ implode(', ', $job->skills) }}</li>
    <li><strong>Salary:</strong> {{ $job->salary }}</li>
    <li><strong>Experience Level:</strong> {{ $job->experience_level }}</li>
    <li><strong>Country:</strong> {{ $job->country->name }}</li>
</ul>
</body>
</html>
