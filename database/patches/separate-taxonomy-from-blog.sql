RENAME TABLE  moxca_blog_terms TO  moxca_terms;
RENAME TABLE  moxca_blog_term_relationships TO  moxca_terms_relationships;
RENAME TABLE  moxca_blog_terms_taxonomy TO  moxca_terms_taxonomy;
DROP TABLE `moxca_blog_categories`;
ALTER TABLE moxca_blog_posts DROP COLUMN category;
