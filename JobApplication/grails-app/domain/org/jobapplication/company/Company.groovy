package org.jobapplication.company

class Company {
	String name
	String address
	String POBox
	String postalCode
	String town
	String state
	String phone
	String fax
	String departement
	String email
	String website
	String category 
	
    static constraints = {
		name(blank: false)
		address(blank: true)
		POBox(blank: true)
		postalCode(blank: true)
		town(blank: false)
		state(blank: true)
		phone(blank: true)
		fax(blank: true)
		departement(blank: true)
		email(blank: true)
		website(blank: true)
		category(blank: true)
    }
}
