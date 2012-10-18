RulerBundle
===========

[![Build Status](https://secure.travis-ci.org/rezzza/RulerBundle.png)](http://travis-ci.org/rezzza/RulerBundle)

A simple stateless production rules engine for Symfony 2.

Roadmap
=======

- ✔ Add a layer for Inference + Proposition.
- ✔ Add asserter (match).
- ✔ Configuration
- ✔ Allow to add dynamically asserters via @tag.
- ✗ Test OR, XOR, AND, etc ...
- ✗ Create dynamically Inference via a Form.
- ✗ Create a DSL to insert/fetch on storage. (using hoa/compiler ?)
- ✗ Create a standalone library + a bundle.

# Configuration

```
rezzza_ruler:
	inferences:
		cart.price_total:
			type:        decimal
			description: Cart total price is
		cart.created_at:
			type:        datetime
			description: Cart was created at
		cart.contain_product:
			type:        product
			# Your own asserter (see Add an asserter)
			# You'll return a list of product and return an array.
            # Not yet implements, we'll have to finish ui via forms.
			description: Cart contain product
```

# Add an asserter.

In this example, we'll create `product` asserter, this one will fetch on storage list of product.

1) Create asserter class

```php
<?php

namespace Acme\Bundle\Asserter\Product;

use Rezzza\RulerBundle\Ruler\Asserter\AbstractAsserter;
use Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface;

class Product extends AbstractAsserter implements AsserterInterface
{
    public function __construct()
    {
        // here we have to define operators and them callback.
,
        // $left his the product id you choose on UI (WIP)
        // $right is what you entered on context with key "cart.contain_product"
        // We suppose here $right is an array and we would check if $left is in $right.

        $this->operators['contains'] = function ($left, $right) {
            return in_array($left, $right);
        };
    }
}
```

2) Define the service and tag it.

```xml
<services>
    <service id="acme.bundle.asserter.product" class="\Acme\Bundle\Asserter\Product">
        <tag name="rezzza.ruler.asserter" id="product" />
        <! --- here, product is the KEY used on config.yml, important ! -->
    </service>
</service>

```

That's all folks !

Glossary
==========

- Inference:   A group of proposition
- Proposition: A rule attached to an inference.

Any idea, suggestion ? Create an issue.
