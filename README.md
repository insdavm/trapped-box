# trapped-box
#### Serving protected web content with NGINX and PHP

----

### The Problem

You've got some stuff you want to be able to serve from your web server, but you want to authenticate clients before you grant them access to the content.

### The Solutions

* IP whitelisting
* HTTP basic authentication
* A full-blown user management / content management system
* A simple script using X-Accel-Redirect (NGINX) or X-Send-File (Apache)

### X-Accel-Redirect

The ```X-Accel-Redirect``` header in NGINX "[allows for internal redirection to a location determined by a header returned from a backend](https://www.nginx.com/resources/wiki/start/topics/examples/x-accel/)".  This means we can have files placed in directories outside of the web root (```/var/www/html/``` in our example) and serve them to users based on internal requests (from our PHP script, in this example).

The advantage of this is that we can handle the authentication any way we like.  In this example we're using a simple password to authenticate our clients, but this could easily be expanded to a larger user-management system.
