## WooCommerce Side Cart

WooCommerce Side Cart adds a hidden side cart, with toggle-able visibility via menu link, to your theme. Super light, powerful, and relies mostly on native Woocommerce functionality.

## How it works

![Example 1](screenshots/example-1.png?raw=true "Example 1")

WooCommerce Side Cart adds a fixed icon to the side of your screen that you click to open the side cart.

![Example 2](screenshots/example-2.png?raw=true "Example 2")

When you open it, it looks pretty.

## Features

All of the templates in the templates/ folder are overridable by including the file(s) in your theme folder.

## Javascript Events

There are some events you can manually trigger

1. Open Side Cart

```javascript
$( 'body' ).trigger( 'side_cart_open' );
```

2. Close Side Cart

```javascript
$( 'body' ).trigger( 'side_cart_close' );
```

## Coming Soon

There are quite a few Actions & Filters you can hook into, we will be releasing short documentation that covers these.

## Installation

1. Upload the plugin to the **/wp-content/plugins/** directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Requirements

PHP 5.4+

Wordpress 4+

WooCommerce 2.5+

## License

[GNU General Public License v3.0](http://www.gnu.org/licenses/gpl-3.0.html)