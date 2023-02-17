-- MASTER DATA
SELECT summary_trip.id_trip, data_driver.nama_driver, data_driver.no_plat, summary_trip.date_trip, data_cost.point_start, data_cost.point_end, SUM( (SELECT data_cost.distance FROM data_cost WHERE data_cost.id_cost = summary_trip.id_cost GROUP BY summary_trip.id_driver) ) as 'total', data_cost.standard_time, data_cost.price_per_km, summary_trip.actual_time, summary_trip.total_cost
FROM `summary_trip`
JOIN data_cost ON data_cost.id_cost = summary_trip.id_cost
JOIN data_driver ON data_driver.id_driver = summary_trip.id_driver
WHERE summary_trip.date_trip = '2021/01/05'
GROUP BY summary_trip.id_driver
ORDER by total DESC
LIMIT 1;

-- 1
SELECT data_driver.nama_driver, data_driver.no_plat, summary_trip.date_trip, 
SUM( 
    (SELECT data_cost.distance FROM data_cost WHERE data_cost.id_cost = summary_trip.id_cost GROUP BY summary_trip.id_driver) 
) as 'jarak_terjauh'
FROM `summary_trip`
JOIN data_cost ON data_cost.id_cost = summary_trip.id_cost
JOIN data_driver ON data_driver.id_driver = summary_trip.id_driver
WHERE summary_trip.date_trip = '2021/01/05'
GROUP BY summary_trip.id_driver
ORDER by jarak_terjauh DESC
LIMIT 1;

-- 2
SELECT data_driver.nama_driver, data_driver.no_plat,
SUM( 
    (SELECT data_cost.distance FROM data_cost WHERE data_cost.id_cost = summary_trip.id_cost GROUP BY summary_trip.id_driver) 
) as 'jarak_terjauh'
FROM `summary_trip`
JOIN data_cost ON data_cost.id_cost = summary_trip.id_cost
JOIN data_driver ON data_driver.id_driver = summary_trip.id_driver
WHERE summary_trip.date_trip >= '2021/01/01' AND summary_trip.date_trip <= '2021/01/31'
GROUP BY summary_trip.id_driver
ORDER by jarak_terjauh DESC
LIMIT 2;

-- 3
SELECT data_driver.nama_driver, data_driver.no_plat, summary_trip.date_trip, data_cost.point_start, data_cost.point_end, data_cost.distance, data_cost.standard_time, data_cost.price_per_km, summary_trip.actual_time, summary_trip.total_cost, (summary_trip.actual_time - data_cost.standard_time) AS 'selisih' 
FROM `summary_trip`
JOIN data_cost ON data_cost.id_cost = summary_trip.id_cost
JOIN data_driver ON data_driver.id_driver = summary_trip.id_driver
WHERE summary_trip.date_trip >= '2021/01/01' AND summary_trip.date_trip <= '2021/01/31' 
ORDER BY selisih DESC;

-- 3 FIX
SELECT data_driver.nama_driver, data_driver.no_plat,
(SUM(summary_trip.actual_time) - SUM( 
    (SELECT data_cost.standard_time FROM data_cost WHERE data_cost.id_cost = summary_trip.id_cost GROUP BY summary_trip.id_driver) 
) )
 as 'telat'
FROM `summary_trip`
JOIN data_cost ON data_cost.id_cost = summary_trip.id_cost
JOIN data_driver ON data_driver.id_driver = summary_trip.id_driver
WHERE summary_trip.date_trip >= '2021/01/01' AND summary_trip.date_trip <= '2021/01/31'
GROUP BY summary_trip.id_driver
ORDER by telat DESC
LIMIT 1;

-- 4
SELECT summary_trip.id_trip, data_driver.nama_driver, data_driver.no_plat, summary_trip.date_trip, data_cost.point_start, data_cost.point_end, data_cost.distance, data_cost.standard_time, data_cost.price_per_km, summary_trip.actual_time, summary_trip.total_cost, COUNT(summary_trip.actual_time - data_cost.standard_time) AS 'jumlah_telat' 
FROM `summary_trip`
JOIN data_cost ON data_cost.id_cost = summary_trip.id_cost
JOIN data_driver ON data_driver.id_driver = summary_trip.id_driver
WHERE (summary_trip.actual_time - data_cost.standard_time) != 0
GROUP BY data_driver.nama_driver
ORDER BY jumlah_telat DESC;

-- 5
SELECT date_trip, MAX(total_cost)
FROM summary_trip
WHERE total_cost < (SELECT MAX(total_cost) FROM summary_trip);

-- 6
SELECT data_driver.nama_driver, MAX(summary_trip.total_cost)
FROM summary_trip
JOIN data_driver ON data_driver.id_driver = summary_trip.id_driver
WHERE summary_trip.total_cost = (SELECT MAX(total_cost) FROM summary_trip);