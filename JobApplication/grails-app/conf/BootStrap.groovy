import org.jobapplication.company.Company

class BootStrap {

    def init = { servletContext ->
		// Check whether the test data already exists.
		if (!Company.count()) {
			new Company(name: "Almerys",
				town: "Toulouse",
				address:"5 avenue Marcel Dassault",
				POBox : "66666",
				postalCode : "31500",
				state : "France",
				phone : "05 62 47 35 08",
				fax : "05 62 47 35 09",
				departement : "handicap lourd",
				email : "contact@almerys.com",
				website : "http://www.almerys.com",
				category : "company").save(failOnError: true)
			new Company(name: "Valtech",
				town: "Toulouse",
				address:"5 avenue Marcel Dassault",
				POBox : "",
				postalCode : "31500",
				state : "France",
				phone : "+33 (0)5 62 47 64 00",
				fax : "+33 (0)5 62 47 64 10",
				departement : "",
				email : "",
				website : "http://www.valtech.fr",
				category : "société").save(failOnError: true)
		}
    }
    def destroy = {
    }
}
