{% extends "../layouts/base.volt" %}

{% block title %}Login{% endblock %}

{% block content %}

{% if cookies.has('username') %}
	
{% endif %}

<div class="row-centered">
	<div class="card login-card">
		<img class="avatar" src="{{url('assets/logo.png')}}">
		<h1 class="text-center text-secondary">Log In <span class="text-info">Administrator</span></h1>
		<div class="notif-block">
			{% if flash != null  %}
				<div class="alert alert-danger text-center">{{ flash.output() }}</div>
			{% endif %}
		</div>
		<div class="col-md-6" style="margin-left:12vw;">
			{{ form.startForm()}}
				<div class="form-group">
					{{form.render('username') }}
				</div>
				<div class="form-group">
					{{ form.render('password') }}
				</div>
				<div class="form-group">
				{{ form.render('Login') }}
				</div style="margin-left:50px;">
					{{ form.render('remember') }}
					{{ form.getLabel('remember') }}
				</div>
			{{ form.endForm() }}
		</div>
	</div>
</div>

{% endblock %}