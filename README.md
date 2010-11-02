Headless Wordpress
==================

Use Wordpress for it's gorgeous back-end.

This plugin disables everything but the Wordpress admin. It redirects most urls to the admin. All front-end related stuff is disabled (Appearance menu) and permalinks are customizably overrided. 

Wordpress is a great platform, but I'm tired of writing customizations in PHP. This plugin is meant to encourge front-end development in other languages. Use something like the [JSON-API Wordpress plugin](http://wordpress.org/extend/plugins/json-api/) or [django-wordpress](http://github.com/sunlightlabs/django-wordpress) as a bridge. Integrate content and data and don't worry about learning a new CMS.

<code>
cd wp-content/plugins
git clone http://github.com/ryanmark/wp-headless.git headless
</code>
