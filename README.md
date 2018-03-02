# Silverstripe html tag


## Installation
Composer is the recommended way of installing SilverStripe modules.
```
composer require gorriecoe/silverstripe-htmltag
```

## Requirements

- silverstripe/framework ^4.0

## Maintainers

- [Gorrie Coe](https://github.com/gorriecoe)

## Template usage

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

## Controller/Object usage

```php

use gorriecoe\HTMLTag\View\HTMLTag;

class MyController extends Controller
{
    public function Title()
    {
        $title = HTMLTag::create($this->Data()->Title, 'h1')
            ->setPrefix($this->Class);
        if (true) {
            $title->setClass('title')
        }
        return $title;
    }
}
```
Accessing and modifying the output in the template
```
<div>
    {$Title.addClass('anotherclass')}
</div>
```
