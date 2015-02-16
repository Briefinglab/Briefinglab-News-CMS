BriefingLab Slider CMS
===============

OK there are a lot of plugin to manage your sliders. Plugins full of effects and very nice feature, really impressive. But ok when you install it you have tons of features and tons of JS included that yo really need? always?
This plugin give you a CMS section to manage the slider content with the usual and very well known WordPress structure. Then it will provide you the possibility to implement
your own HTML and JS in a very structured. It tries to make order between content and views.
you can create a slide like a post. you can organize sliders categorizing more post with the same category.
then you can print out your slider using the default HTML provided (bootrstrap carousel) or make your own HTML overwriting two simple templates:
bl-slider-container
bl-slider-item

you can then integrate a slider in your theme on in your post content using a simple shortcode
[bl-slider category="homepage"]

you can override the output also by category using
bl-slider-container-category-slug
bl-slider-item-category-slug

you can also override the output for a single page
bl-slider-container-page-slug
bl-slider-item-page-slug

you can also override the output for different slider in the same page (you have to add template-slug also in the short code [bl-slider category="homepage" template="template-slug"])
bl-slider-container-template-slug
bl-slider-item-template-slug

overwrite priority
template-slug
page-slug
category-slug
default