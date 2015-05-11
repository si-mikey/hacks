#!/usr/bin/env ruby 

(1...100).each do |n|
  puts "#{n} fizz" if n % 3 == 0
  puts "#{n} buzz" if n % 5 == 0
  puts "#{n} fizzbuzz" if n % 3 == 0 && n % 5 == 0
end







