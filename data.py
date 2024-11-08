import pandas as pd

df = pd.read_csv('taichung.csv', encoding='utf-8')

#兒童總計
for i in range(0, 1875, 3):
    child = df.iloc[i, 3:6].sum()
    boy = df.iloc[i + 1, 3:6].sum()
    girl = df.iloc[i + 2, 3:6].sum()
    df.loc[i, '兒童統計'] = child
    df.loc[i + 1, '男孩統計'] = boy
    df.loc[i + 2, '女孩統計'] = girl
    child = 0

#少年總計
for i in range(0, 1875, 3):
    young = df.iloc[i, 6:9].sum()
    yboy = df.iloc[i + 1, 6:9].sum()
    ygirl = df.iloc[i + 2, 6:9].sum()
    df.loc[i, '少年統計'] = young
    df.loc[i + 1, '男少年統計'] = yboy
    df.loc[i + 2, '女少年統計'] = ygirl
    young = 0

#壯年總計
for i in range(0, 1875, 3):
    prime = df.iloc[i, 9:12].sum()
    men = df.iloc[i + 1, 9:12].sum()
    women = df.iloc[i + 2, 9:12].sum()
    df.loc[i, '壯年統計'] = prime
    df.loc[i + 1, '男壯年統計'] = men
    df.loc[i + 2, '女壯年統計'] = women
    prime = 0

#中年總計
for i in range(0, 1875, 3):
    middle = df.iloc[i, 12:16].sum()
    mmen = df.iloc[i + 1, 12:16].sum()
    mwomen = df.iloc[i + 2, 12:16].sum()
    df.loc[i, '中年統計'] = middle
    df.loc[i + 1, '男中年統計'] = mmen
    df.loc[i + 2, '女中年統計'] = mwomen
    middle = 0

#老年總計
for i in range(0, 1875, 3):
    old = df.iloc[i, 12:16].sum()
    omen = df.iloc[i + 1, 12:16].sum()
    owomen = df.iloc[i + 2, 12:16].sum()
    df.loc[i, '老年統計'] = old
    df.loc[i + 1, '男老年統計'] = omen
    df.loc[i + 2, '女老年統計'] = owomen
    old = 0
print(df['兒童統計'].max(), df.iloc[df['兒童統計'].idxmax()].iloc[0, 1])
