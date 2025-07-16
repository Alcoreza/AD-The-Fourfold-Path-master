CREATE TABLE IF NOT EXISTS carts(
    cart_id SERIAL PRIMARY KEY,
    user_id INT UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users (id)
);