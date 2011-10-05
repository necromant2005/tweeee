BEGIN TRANSACTION;
CREATE TABLE "tweets" (
    "id" TEXT,
    "name" TEXT,
    "message" TEXT,
    "timestamp" INTEGER,
    "tweets" TEXT
);
CREATE UNIQUE INDEX "id" on tweets (id ASC);
COMMIT;

