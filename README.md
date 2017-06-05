AA Drupal module for Wunder
---------------------------

It is pretty stupid module: since I had no idea what kind of module to create, I wrote a module about myself.
It can show index page (with basic inforamtion about me), a page with my gihub repositories listed and a page with my home projects.

I wanted to wrap it in Docker container. But my home laptop is 32-bit and Docker does not support those currently.

Besides the basic controller I have written github api client and simple cache for it. The are located in Component directory.
