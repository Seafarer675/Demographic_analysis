import json
import pandas as pd
import os
# 讀取Excel資料
df = pd.read_excel("C:/damnSE/html/mid/台中各區里.xlsx", header=None, names=['country', 'areaname'])

# 將資料轉換成JSON格式
result = []
for country, group in df.groupby('country'):
    area_list = []
    for _, row in group.iterrows():
        area_list.append({"areaname": row['areaname']})
    result.append({"country": country, "AreaList": area_list})

# 將結果輸出為JSON檔案
with open('output.json', 'w', encoding='UTF-8') as f:
    json.dump(result, f, ensure_ascii=False, indent=4)
