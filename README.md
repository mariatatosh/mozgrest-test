#                

----------

## Installation using [Docker](https://www.docker.com)

Clone the repository and switch to the repository folder

    git clone git@github.com:mariatatosh/mozgrest-test.git && cd mozgrest-test

Copy configuration file

    make copy-env

Make the required configuration changes in the .env file

    OXFORD_DICTIONARY_APP_ID=<app_id>
    OXFORD_DICTIONARY_API_KEY=<api_key>

Start the local development server in first time

    make init

You can now access the server at http://localhost

**TL;DR command list**

    git clone git@github.com:mariatatosh/mozgrest-test.git && cd mozgrest-test
    make copy-env
    make init

----------
