import pandas as pd

df = pd.read_excel(r'c:\Users\onyed\Documents\Coding\alumni\FGCO 2007 Alumni Data  (Responses).xlsx')

with open('columns_output.txt', 'w', encoding='utf-8') as f:
    f.write("EXCEL FILE FIELDS:\n")
    f.write("-" * 50 + "\n")
    for i, col in enumerate(df.columns, 1):
        f.write(f"{i}. {col}\n")
    f.write("-" * 50 + "\n")
    f.write(f"Total rows: {len(df)}\n")

print("Output written to columns_output.txt")
