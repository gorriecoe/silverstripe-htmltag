# Silverstripe html tag


## Installation
Composer is the recommended way of installing SilverStripe modules.
```
composer require gorriecoe/silverstripe-embed
```

## Requirements

- silverstripe/framework ^4.0

## Maintainers

- [Gorrie Coe](https://github.com/gorriecoe)

# Template usage

```
{$h1($Title).setClass('title').setPrefix($Class)}
```
Is the equivalent of
```
<% if Title %>
    <h1 class="{$class}__title title">
        {$Title}
    </h1>
<% end_if %>
```
And returns
```html
<h1 class="title content-section__title">
    This sections title
</h1>
```
