// Fountains

// e and pi
// Adapted from https://programmingpraxis.com/2012/06/19/digits-of-e/#comment-4993
function* gen_digits_epi(lo, hi, f) {
    const approx = (abc, n) => abc[0].times(n).plus(abc[1]).div(abc[2]).round(0, 0);
    const mul = (abc, def) => {
        return [
            abc[0].times(def[0]),
            abc[0].times(def[1]).plus(abc[1].times(def[2])),
            abc[2].times(def[2]),
        ]
    }

    function* gen_xs() {
        let i = 0;
        while (true) {
            i++;
            const fi = f(i);
            yield [fi[0], fi[1]*fi[2], fi[1]];
        }
    }
    const xs = gen_xs();

    let z = [new Big(1), new Big(0), new Big(1)];
    let lbound;

    while (true) {
        lbound = approx(z, lo);
        if (lbound.eq(approx(z, hi))) {
            yield parseInt(lbound.valueOf());
            z = mul([new Big(10), new Big(-10*lbound), new Big(1)], z);
        } else {
            z = mul(z, xs.next().value);
        }
    }
}

// Square root of 2 and 3
// Adapted from http://mathforum.org/kb/message.jspa?messageID=542964

function* gen_digits_root23(base) {
    let i = new Big(base);
    let j = new Big(1);
    let k = new Big(1);
    let q = 1;
    while (true) {
        yield q;
        i = i.minus(k.times(q)).times(100);
        k = j.times(20);
        q = 0;
        while (i.gte(k.plus(q).times(q))) {
            q += 1;
        }
        q -= 1;
        j = j.times(10).plus(q);
        k = k.plus(q);
    }
}

// Meta Fountain

const CONSTANTS = ['e', 'pi', 'root2', 'root3'];

function* gen_all_digits() {
    const fountains = {
        'e': gen_digits_epi(1, 2, (k) => [1, k, 1]),
        'pi': gen_digits_epi(3, 4, (k) => [k, 2*k + 1, 2]),
        'root2': gen_digits_root23(2),
        'root3': gen_digits_root23(3),
    };
    while (true) {
        yield CONSTANTS.map((constant) => fountains[constant].next().value);
    }
}


// HTML Page Stuff

let totalDigits = 0;
let fountainsRunning = false;
let fountainsTimeout;

const all_fountains = gen_all_digits();
function run_all_fountains_once() {
    totalDigits++;
    document.getElementById(`td-count`).innerHTML = totalDigits + '\n' + document.getElementById(`td-count`).innerHTML;
    const digits = all_fountains.next().value;
    CONSTANTS.map((constant, idx) => {
        document.getElementById(`td-${constant}`).innerHTML = digits[idx] + '\n' + document.getElementById(`td-${constant}`).innerHTML;
    });
}

function toggle_fountains() {
    fountainsRunning = !fountainsRunning;
    document.getElementById('toggle-button').innerHTML = fountainsRunning ? 'Stop' : 'Go';
    if (fountainsRunning) {
        fountainsTimeout = setInterval(run_all_fountains_once, 0);
    } else {
        clearInterval(fountainsTimeout);
    }
}
