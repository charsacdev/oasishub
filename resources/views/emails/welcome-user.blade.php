@component('mail::message')
# Welcome to Oasis Vista Hub, {{ $user->email }} 👋

We’re excited to have you join our growing community.  
At **Oasis Vista Hub**, you’ll find quality products, trusted vendors, and a smooth shopping experience designed just for you.

---

### 🛍 Get Started
You can now explore products, add items to your cart, and check out securely — all from your dashboard.

@component('mail::button', ['url' => url('/')])
Visit Oasis Vista Hub
@endcomponent

---

### What You Can Do
- Browse items by category and discover new favorites  
- Add products to your wishlist for later  
- Track and manage your orders in real time  
- Receive updates on new arrivals and offers  

---

If you ever need help, our support team is available to assist you anytime.  
We’re thrilled to have you on board and can’t wait for you to start exploring!

Thanks for joining **Oasis Vista Hub** 🌴  

Warm regards,  
**The Oasis Vista Hub Team**  
{{ config('app.name') }}
@endcomponent
