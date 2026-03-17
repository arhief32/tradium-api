CREATE TABLE trades (
    id SERIAL PRIMARY KEY,
    symbol VARCHAR(20) NOT NULL,
    side VARCHAR(10) CHECK (side IN ('LONG', 'SHORT')),
    qty DECIMAL(20, 8) NOT NULL,
    entry_time TIMESTAMP NOT NULL,
    exit_time TIMESTAMP,
    entry_price DECIMAL(20, 8) NOT NULL,
    exit_price DECIMAL(20, 8),
    current_price DECIMAL(20, 8),
    pnl DECIMAL(20, 8),
    entry_fee DECIMAL(20, 8),
    exit_fee DECIMAL(20, 8),
    status VARCHAR(20) CHECK (status IN ('OPEN', 'CLOSED')) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);