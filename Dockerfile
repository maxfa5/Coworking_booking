FROM postgres:15
# COPY db/migrations/V1__Initial_schema_setup.sql /docker-entrypoint-initdb.d/