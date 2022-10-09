@component('mail::message')
## ご予約承りました。

{{$userData->name_kanji}}様、ご予約ありがとうございます。

### ご予約の確認  

ご予約日 : {{$bookData->booked_at}}  
ご予約番号 : {{$bookData->book_code}}  
客室名 : {{$plan->room->title}}  
ベッドタイプ : {{$plan->room->bed_type}}  
その他設備 : {{$plan->room->facilities}}  
プラン : {{$plan->title}}  
チェックイン日 : {{$bookData->checkin_at}}  
チェックアウト日 : {{$bookData->checkout_at}}  
ご利用人数 : 大人{{$bookData->adult_number}}人, 子供{{$bookData->child_number}}人  
お支払い金額 : {{$bookData->total_amount}}円  

-----------
### その他  

チェックイン時間: 15:00〜24:00  
チェックアウト時間: 11:00 

@endcomponent
