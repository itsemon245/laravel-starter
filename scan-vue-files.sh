#!/bin/bash

# Function to convert string to PascalCase
to_pascal_case() {
    local str="$1"
    local pascal_case=$(echo "$str" | sed -r 's/(^|_)([a-z])/\U\2/g')
    echo "$pascal_case"
}

# Function to scan directory for .vue files and create JSON
scan_directory() {
    local dir="$1"
    local files=$(find "$dir" -name '*.vue')

    if [ -z "$files" ]; then
        echo "No .vue files found in $dir"
    else
        local json="{"
        local count=0
        while IFS= read -r file; do
            filename=$(basename -- "$file")
            extension="${filename##*.}"
            filename="${filename%.*}"
            pascal_case=$(to_pascal_case "$filename")
            if [ $count -gt 0 ]; then
                json="$json,"
            fi
            json="$json\"$pascal_case\":\"$filename\""
            ((count++))
        done <<< "$files"
        json="$json}"

        echo "$json" > "$dir/generated.json"
        echo "JSON file created: $dir/generated.json"
    fi
}

# Check if directory is provided as argument
if [ $# -eq 0 ]; then
    echo "Usage: $0 <directory>"
    exit 1
fi

# Check if provided directory exists
if [ ! -d "$1" ]; then
    echo "Error: Directory '$1' not found"
    exit 1
fi

# Call function to scan directory for .vue files and create JSON
scan_directory "$1"
