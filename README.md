RulerBundle
===========

[![Build Status](https://secure.travis-ci.org/rezzza/RulerBundle.png)](http://travis-ci.org/rezzza/RulerBundle)

A simple stateless production rules engine for Symfony 2.

Integration of  [Hoa\Ruler](https://github.com/hoaproject/Ruler) library.

Roadmap
=======

- Create dynamically Propositions via a Form and persist them on storage.
- Dynamics inferences

# Configuration

```yaml
rezzza_ruler:
    context_builder: service.id
    # or
    #context_builder:
    #    default: service.id
    events:
        event.cart.paid: 'Cart paid'
        # or
        event.cart.paid:
            label: 'Cart paid'
            context_builder: default
    inferences:
        cart.price_total:
            # This will show this inferences only when event event.cart.paid
            # will be selected on UI.
            # This is optional.
            event:       [event.cart.paid]
            type:        decimal
            description: Cart total price is
        cart.created_at:
            type:        date
            description: Cart was created at
        cart.contain_product:
            type:        product
            # Your own asserter (see chapter Add an asserter)
            # You'll return a list of product as array.
            # Not yet implemented, we'll have to finish ui via forms.
            description: Cart contain product
```

# Usage

```php
<?php

$rb = $container->get('rezzza.ruler.rule_builder');

$rule = $rb->and(
    $rb->{'>='}($rb->variable('cart.price_total'), 100),
    $rb->{'>='}($rb->context('cart.created_at'), '2011-06-10')
);

$context = $container->get('rezzza.ruler.context_builder')->createContext('default');
$context = $container->get('rezzza.ruler.context_builder')->createContextFromEvent('event.cart.paid');

echo $container->get('rezzza.ruler')->assert($rule, $context); // true or false
```

# Serialization

To store rules on a storage, you can serialize it, store it on storage, fetch it from storage, and deserialize it. Context does not stay on storage.

```php

$rb = $container->get('rezzza.ruler.rule_builder');

$rule = $rb->and(
    $rb->{'>='}($rb->context('cart.price_total'), 100),
    $rb->{'>='}($rb->context('cart.created_at'), '2011-06-10')
);

$string = (string) $rule; // cart.price.total >= 100 AND cart.created_at >= 2011-06-10

$rule = $container->get('rezzza.ruler')->interprete($string);
```

# Add custom functions

Define a service with `rezzza.ruler.functions` tag.

```xml
<service id="acme.ruler.functions" class="Acme\Ruler\Functions">
    <tag name="rezzza.ruler.functions" />
</service>
```

Then the php class:

```php
<?php

namespace Acme\Ruler\Functions;

use Rezzza\RulerBundle\Ruler\FunctionCollectionInterface;

class FunctionCollection implements FunctionCollectionInterface
{
    public function getFunctions()
    {
        return array(
            'version_compare' => function($left, $comparator, $right) {
                return version_compare($left, $comparator, $right);
            },
        );
    }
}
```

That's all folks !

Glossary
==========

- Inference:   A group of proposition
- Proposition: A rule attached to an inference.

Any idea, suggestion ? [Create an issue](https://github.com/rezzza/RulerBundle/issues/new).
