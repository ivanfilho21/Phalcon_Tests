{% set topMenu = [
    'index': [
        'title': 'Home',
        'uri': static_url(''),
        'with_auth': false
    ],
    'invoices': [
        'title': 'Invoices',
        'uri': static_url('invoices/index'),
        'with_auth': true
    ],
    'about': [
        'title': 'About',
        'uri': static_url('about/index'),
        'with_auth': false
    ],
    'contact': [
        'title': 'Contact',
        'uri': static_url('contact/index'),
        'with_auth': false
    ]
] %}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <a class="navbar-brand" href="{{ static_url('') }}">INVO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            {% for controller, menu in topMenu %}
                {% if (session.has('auth') and menu['with_auth'] === true) or menu['with_auth'] === false %}
                <li class="nav-item {% if controller == dispatcher.getControllerName()|lower %}active{% endif %}">
                    <a class="nav-link" href="{{ menu['uri'] }}">{{ menu['title'] }}</a>
                </li>
                {% endif %}
            {% endfor %}
        </ul>

        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    {% if session.has('auth') %}
                    <a class="nav-link" href="{{ static_url('signout') }}">Log Out</a>
                    {% else %}
                    <a class="nav-link" href="{{ static_url('signin') }}">Log In</a>
                    {% endif %}
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    {{ flash.output() }}
    {{ content() }}
    <hr>
    <footer>
        <p>&copy; Company {{ date('Y') }}</p>
    </footer>
</div>