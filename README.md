## Running the project with Docker Compose

### After cloning the repository from gitHub:

Copy .env.example (if `.env` file not exists):

```bash
cp .env.example .env
```

and set some parameters in `.env` file,
for example, `FORWARD_DB_PORT`, `FORWARD_REDIS_PORT`, `DB_PASSWORD`, `DB_HOST` etc,
if needed!

Then run:

```bash
make init
```

or run the commands you need from the Makefile.

## Testing API with Postman

In [Postman app](https://www.postman.com/downloads/) import `z-test-backend.postman_collection.json`
and `z-test-backend.postman_environment.json files`, located in `documentation` directory of this repository. Then
choose the `z-test-backend environment` and test API.
