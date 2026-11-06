#!/bin/bash
# Double-click this file to run Footy on your computer.
cd "$(dirname "$0")"

PHP="$(command -v php || echo "$HOME/.local/bin/php")"
if [ ! -x "$PHP" ]; then
  echo "PHP not found. Install it (for example with Homebrew: brew install php)."
  read -n 1 -s -r -p "Press any key to close"
  exit 1
fi

echo "Footy is running at http://localhost:8000"
echo "Keep this window open. Close it (or press Ctrl+C) to stop."
(sleep 1 && open "http://localhost:8000") &
"$PHP" -S localhost:8000
