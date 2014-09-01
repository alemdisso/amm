UPDATE `author_collection_editions` SET uri = SUBSTRING(uri, 1, LENGTH(uri)-1),title = TRIM(title) WHERE uri LIKE '%-'
