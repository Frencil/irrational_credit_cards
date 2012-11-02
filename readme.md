Irrational Credit Cards
=======================

The Game
--------

Pick an irrational number, like pi.

How many valid credit cards are there in the first n digits of that number?

Pick another irrational number, like e.

How many valid credit cards are there in the first n digits of *that* number?
More than the first number? Less?

Why?

The Project
-----------

Here's a silly little afternoon project to try to answer all of the above questions. Except maybe for Why. That may be unanswerable.

This is a PHP script designed to take a list of irrational numbers (stored externally and statically) and march through their digits counting up the credit card numbers. As many rules as possible of client-side credit card validation apply (luhn checks and card-vendor-specific formats). Put another way, the "matches" are all *valid-looking*. While they could certainly be used for, say, testing a credit card API, there is no gaurantee (or bank-side verification) that these are legitimate credit cards.

This is not a project to try to mine credit card data, either. Did you read _Contact_ by Carl Sagan? The movie doesn't count; you'd have to read the book. The big payoff/mystery at the end that never made it into the film - that's sort of along the same lines as this. Although this is a lot less cosmic-truthy and more just dinking around with random numbers.

That's pretty much it.

Preliminary Findings
--------------------

In their first 10,000 digits, the following irrationals have the following numbers of cards:

* pi - **217**
* e - **218**
* square root of 2 - **218**
* square root of 3 - **219**
* phi (the golden ratio) - **184**
* gamma (Euler's constant) - **213**

What does this mean? Hell if I know.

What's Next
-----------

**More Everything**

More digits, more irrationals. Maybe more niche card types.

**Card Type Distribution**

The script is presently smart enough to know which type of card it found (Visa/Amex/Discover/etc). Maybe it would be cool to see the distribution of card types across the different irrationals. Maybe phi is loaded up with Mastercards for some reason.

**Various Values of n**

At 10,000 digits all but phi are within a few matches of each other in terms of volume. Does the number of matches scale linearly with the number of digits and phi just goes at a slower rate than the others? Maybe fomr some values of n digits the distribution is a lot more varied, like a horse race where the leader is constantly switching. This is good fodder for visualization down the line.

What's the point?
-----------------

Math.
