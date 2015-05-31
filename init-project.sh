#!/bin/sh -e
# This tool can be used to initialise the template after making a fresh copy to get started quickly.
# The goal is to make it as easy as possible to create scripts that allow easy testing and continuous integration.

CAMEL=$(echo "${1}" | grep -E '^([A-Z][a-z0-9]+){2,}$') || CAMEL=""

if [ "${CAMEL}" = "" ]; then
    echo "Usage: ${0} MyUpperCamelCaseProjectName"
    exit 1
fi

DASH=$(echo "${CAMEL}" | sed -E 's/([A-Za-z0-9])([A-Z])/\1-\2/g' | tr '[:upper:]' '[:lower:]')
INITIALS=$(echo "${CAMEL}" | sed 's/\([A-Z]\)[a-z]*/\1/g' | tr '[:upper:]' '[:lower:]' )

echo "Camel: ${CAMEL}"
echo "Dash: ${DASH}"
echo "Initials: ${INITIALS}"

sed -i "" -e "s/ExampleApplication/${CAMEL}/g" bin/example-script web/index.php src/ExampleNamespace/ExampleApplication.php test/Unit/ExampleNamespace/ExampleApplicationTest.php
sed -i "" -e "s/ExampleNamespace/${CAMEL}/g" bin/example-script web/index.php src/ExampleNamespace/ExampleApplication.php test/Unit/ExampleNamespace/ExampleApplicationTest.php
sed -i "" -e "s/php-skeleton/${DASH}/g" composer.json sonar-project.properties
sed -i "" -e "s/example-project/${DASH}/g" composer.json

git mv src/ExampleNamespace/ExampleApplication.php "src/ExampleNamespace/${CAMEL}.php"
git mv test/Unit/ExampleNamespace/ExampleApplicationTest.php "test/Unit/ExampleNamespace/${CAMEL}Test.php"
git mv src/ExampleNamespace "src/${CAMEL}"
git mv test/Unit/ExampleNamespace "test/Unit/${CAMEL}"
git mv bin/example-script "bin/${INITIALS}"

echo "Done. Files were edited and moved using git. Review those changes. You may also delete this script now."
