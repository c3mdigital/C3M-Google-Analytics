# C3M Google Analytics WordPress Plugin #

## Description ##

WordPress plugin to add Google Analytics Tracking Code including the new tracking for page load time

The inspiration for writing this plugin came from this question on WordPress.Stackexchange.com http://wordpress.stackexchange.com/questions/16406/analytics-plugins-that-allow-for-inclusion-of-trackpageloadtime

### Installation Instructions ###

1. Upload C3M-Google-Analytics.zip to WordPress using the plugin installer

2. Activate plugin

3. Add your Google Analytics User ID by going to Settings -> c3m google analytics

#### FAQ ####

Q.) Where is the tracking code output?  
A.) It's output in your footer using the wp_footer hook

Q.) Does this include the new page load time tracking?  
A.) Yes