<h1>Applicaition Submitted</h1>
<p>Dear {{$careerCv->name}},</p>
<p>
    We have received your cv for "{{$careerCv->career->job_title ?? ''}}" and it will be reviewed soon!
</p>
Thanks,<br>
{{ config('panel.website_title') }}