EDC Base Admin
=======

### Getting Started

This bundle use **Bootstrap 5.1.3** and **jQuery 3.6**.

This bundle includes 2 views with a set of css and js assets:
- login.html.twig: Simple page layout with a great style.
- base.html.twig: Minimal Admin layout.

### How to use

1) Enable this bundle at AppKernel o bundles.php:

```
return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    ...
    EDC\BaseAdminBundle\EDCBaseAdminBundle::class => ['all' => true],
];
```


2) Add configuration file:

```
edc_base_admin:
    site_name: 'site tile'
    login_check: _route_name_or_url_to_login_check
    logout: _route_name_or_url_to_logout
    admin_home: _route_name_or_url_to_admin_homepage

```

3) To show login page simply create your own login.html.twig and add:

```
{% include ('@EDCBaseAdmin/login.html.twig') %}
```

4) For admin layout, create a template called for example _layout.html.twig_ and add:

```
{% extends '@EDCBaseAdmin/base.html.twig' %}

{% block title %} _YOUR_CUSTOM_HTML_TITLE_ {% endblock %}

{% block sidebar %}
    _YOUR_CUSTOM_SIDEBAR_MENU_
{% endblock %}

{% block dropdown %}
    _YOUR_CUSTOM_DROPDOWN_MENU_BELOW_USERNAME_
{% endblock %}

{% block footer %}
   _YOUR_CUSTOM_FOOTER_BELOW_USERNAME_
{% endblock %}

```

5) And at last, for each page inside admin control panel, you only need to extends from your layout.html.twig. For example, for dashboard.html.twig:
```
{% extends 'admin/layout.html.twig' %}

{% block content %}
    _YOUR_DASHBOARD_CONTENT_PAGE_
{% endblock %}
```

### Bonus

#### Form Themes
By default we add the [Bootstrap 5 Form Themes](https://github.com/symfony/symfony/blob/master/src/Symfony/Bridge/Twig/Resources/views/Form/bootstrap_5_layout.html.twig), also we have improved:

- **VichImageWidget**: Added class "img-thumbnail" from Bootstrap 5 to image preview.


- **FilepondType**: An usefull Form AbstractType that help us to upload multiple (or single) files/images. A compounded type with 2 childs:
  - Childs:
    - _uploader_: FileType field to handle file uploads.
    - _files_: HiddenType field to handle list of files uploaded.
  - Options:
    - 'multiple' => Allow upload multiple files (Bool)
    - 'uploadUri' => Path to request for upload files (String)
    - 'removeUri' =>  Path to request for remove files (String)
    - 'files' => A simple array containing paths to show images,
    - 'acceptedFileTypes' => List (coma separated) of allowed Mime Types (String)
