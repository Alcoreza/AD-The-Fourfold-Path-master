CREATE TABLE IF NOT EXISTS  items (
    item_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    stock_quantity INT DEFAULT 0,
    image_url TEXT,
    description TEXT,
    isDELETED BOOLEAN DEFAULT FALSE
);