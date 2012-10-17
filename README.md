RulerBundle
===========

[![Build Status](https://secure.travis-ci.org/rezzza/RulerBundle.png)](http://travis-ci.org/rezzza/RulerBundle)

A simple stateless production rules engine for Symfony 2.

Roadmap
=======

- ✔ Add a layer for Inference + Proposition.
- ✔ Add asserter (match).
- ✗ Configuration
- ✗ Allow to add dynamically asserters via @tag.
- ✗ Create dynamically Inference via a Form.
- ✗ Create a DSL to insert/fetch on storage. (using hoa/compiler ?)
- ✗ Create a standalone library + a bundle.

# Configuration (WIP)

rezzza_ruler:
	inferences:
		cart.price_total:
			type:        Decimal
			description: Cart total price is
		cart.created_at:
			type:        Datetime
			description: Cart was created at
		cart.contain_product:
			type:        CartProduct
			# Your own asserter
			# You'll return a list of product and return an array.
			description: Cart contain product

Glossary
==========

- Inference:   A group of proposition
- Proposition: A rule attached to an inference.

Any idea, suggestion ? Create an issue.

