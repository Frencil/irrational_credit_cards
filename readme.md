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

Here's a silly little afternoon project to try to answer all of the above questions (except for Why).

This is a PHP script designed to take a list of irrational numbers (stored externally and statically) and march through their digits counting upo the credit card numbers. As many rules as possible of client-side credit card validation apply (luhn checks and card-vendor-specific formats).

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

Obviously: more digits, more irrationals. Maybe more niche card types.

Otherwise: the script is presently smart enough to know which type of card it found (Visa/Amex/Discover/etc). Maybe it would be cool to see the distribution of card types across the different irrationals. Maybe phi is loaded up with Mastercards for some reason.

At 10,000 digits all but phi are within a few matches of each other in terms of volume. Does the number of matches scale linearly with the number of digits and phi just goes at a slower rate than the others? Maybe fomr some values of n digits the distribution is a lot more varied, like a horse race where the leader is constantly switching. This is good fodder for visualization down the line.

What's the point?
-----------------

Math.
