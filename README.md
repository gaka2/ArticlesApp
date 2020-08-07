# Installation

Run:
```
git clone <repository_url>
composer install
```

# Usage

```
php src/console.php csv:simple https://blog.nationalgeographic.org/rss file.csv
php src/console.php csv:extended https://blog.nationalgeographic.org/rss file.csv
```

# Tests

Run:
```
vendor/bin/phpunit test
```