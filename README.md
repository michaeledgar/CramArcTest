# CramArcTest

CramArcTest provides an
[arcanist](https://secure.phabricator.com/book/phabricator/article/arcanist/)
unit test runner, `CramTestEngine`, integrating with
[cram](https://bitheap.org/cram/).

# Installation

    git clone https://github.com/michaeledgar/cramarctest
    arc set-config load '["'$(pwd)'/cramarctest/src/"]'

Then in `.arcconfig`, set `"unit.engine" : "CramTestEngine"`.

# License

CramArcTest is licensed under the Apache License, version 2. See the LICENSE file
that accompanies this distribution for the full text of the license.
