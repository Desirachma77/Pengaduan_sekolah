<div class="profile-section">
    <!-- Profile Header Section -->
    <div class="profile-header">
        <!-- Profile Icon (gear icon) -->
        <img src="{{ asset('assets/images/profile-icon.png') }}" alt="Profile Icon" class="profile-icon">

        <!-- Profile Info (Name and Username) -->
        <div class="profile-info">
            <h4 class="profile-name">{{ $name }}</h4>
            <p class="profile-username">{{ $username }}</p>
        </div>
    </div>
    
    <!-- Logout Button -->
    <button class="logout-button">Logout</button>
</div>
